<?php
// Centralised authentication helper for unified login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/include/config.php';

/**
 * Detect if a stored password looks like a bcrypt hash.
 */
function is_bcrypt_hash($hash)
{
    return is_string($hash) && preg_match('/^\$2[ayb]\$/', $hash);
}

/**
 * Verify a plain password against a stored value with backward compatibility.
 *
 * Priority:
 *  - If stored is bcrypt -> password_verify
 *  - Else accept MD5 match
 *  - Else accept plain-text match (for old admin password)
 */
function verify_legacy_password($plainPassword, $storedPassword)
{
    if (!is_string($storedPassword) || $storedPassword === '') {
        return false;
    }

    // New secure path: bcrypt
    if (is_bcrypt_hash($storedPassword)) {
        return password_verify($plainPassword, $storedPassword);
    }

    // Legacy MD5 (patients, doctors currently)
    if (md5($plainPassword) === $storedPassword) {
        return true;
    }

    // Fallback: plain-text equality (current admin implementation)
    if ($plainPassword === $storedPassword) {
        return true;
    }

    return false;
}

/**
 * Authenticate against admin, doctors, then users.
 *
 * @param string $username  Username/email entered by user
 * @param string $password  Plain text password entered by user
 * @return array|null       [ 'role' => 'admin|doctor|patient', 'id' => int, 'username' => string ] or null on failure
 */
function unified_authenticate($username, $password)
{
    global $con;

    $username = mysqli_real_escape_string($con, $username);

    // 1) Try admin table (uses username field)
    $sqlAdmin = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    if ($res = mysqli_query($con, $sqlAdmin)) {
        if ($row = mysqli_fetch_assoc($res)) {
            if (verify_legacy_password($password, $row['password'])) {
                return [
                    'role'     => 'admin',
                    'id'       => (int) $row['id'],
                    'username' => $row['username'],
                ];
            }
        }
    }

    // 2) Try doctors table (email as username)
    $sqlDoc = "SELECT * FROM doctors WHERE docEmail='$username' LIMIT 1";
    if ($res = mysqli_query($con, $sqlDoc)) {
        if ($row = mysqli_fetch_assoc($res)) {
            if (verify_legacy_password($password, $row['password'])) {
                return [
                    'role'     => 'doctor',
                    'id'       => (int) $row['id'],
                    'username' => $row['docEmail'],
                ];
            }
        }
    }

    // 3) Try users table (patients, email as username)
    $sqlUser = "SELECT * FROM users WHERE email='$username' LIMIT 1";
    if ($res = mysqli_query($con, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($res)) {
            if (verify_legacy_password($password, $row['password'])) {
                return [
                    'role'     => 'patient',
                    'id'       => (int) $row['id'],
                    'username' => $row['email'],
                ];
            }
        }
    }

    return null;
}

/**
 * Set unified + legacy session keys for compatibility with existing code.
 */
function set_unified_session(array $auth)
{
    // New unified structure
    $_SESSION['user_id'] = $auth['id'];
    $_SESSION['role']    = $auth['role'];

    // Backwards-compatible keys for existing dashboards
    if ($auth['role'] === 'admin') {
        $_SESSION['login'] = $auth['username'];
        $_SESSION['id']    = $auth['id'];
    } elseif ($auth['role'] === 'doctor') {
        $_SESSION['dlogin'] = $auth['username'];
        $_SESSION['id']     = $auth['id'];
    } elseif ($auth['role'] === 'patient') {
        $_SESSION['login'] = $auth['username'];
        $_SESSION['id']    = $auth['id'];
    }
}
