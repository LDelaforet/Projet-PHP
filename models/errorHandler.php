<?php
class AppException extends Exception
{
    private $errorType;
    public function __construct($message, $errorType = 'error', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorType = $errorType;
    }
    public function getErrorType()
    {
        return $this->errorType;
    }
}

class ValidationException extends AppException
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 'validation', $code, $previous);
    }
}

class DatabaseException extends AppException
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 'database', $code, $previous);
    }
}

class AuthenticationException extends AppException
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 'authentication', $code, $previous);
    }
}

class AuthorizationException extends AppException
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 'authorization', $code, $previous);
    }
}

class NotFoundException extends AppException
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 'not_found', $code, $previous);
    }
}

function handleException($exception)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['error'] = [
        'message' => $exception->getMessage(),
        'type' => $exception instanceof AppException ? $exception->getErrorType() : 'error'
    ];
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?page=films';
    header('Location: ' . $referer);
    exit;
}

set_exception_handler('handleException');

function jsonSuccess($data = null, $message = null)
{
    $response = ['success' => true];
    if ($message)
        $response['message'] = $message;
    if ($data !== null)
        $response['data'] = $data;
    header('Content-Type: application/json');
    echo json_encode($response);
}

function jsonError($message, $code = 400)
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $message]);
}
