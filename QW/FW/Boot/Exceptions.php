<?php

namespace QW\FW\Boot;

// Main Exceptions
use QW\FW\Basic\Object;

class LoggedException extends \Exception {

	public function __construct( $message = '', $code = 0, \Exception $previous = NULL ) {
		parent::__construct( $message, $code, $previous );
		AbstractRouter::getGlobalLogger()
		              ->log( $message );
	}
}

class MyException extends \Exception {

	public function __construct( $message = '', $logged = FALSE, $code = 0, \Exception $previous = NULL ) {
		parent::__construct( $message, $code, $previous );

		if ( $logged == TRUE || Object::getAllDebug() ) new LoggedException( $message, $code, $previous );
	}
}

class ProgrammerExceptions extends MyException {
}

class ProgrammerLoggedException extends LoggedException {
}

class UnsupportedOperationException extends ProgrammerExceptions {
}

class MemberAccessException extends ProgrammerExceptions {
}

final class PrivateConstructException extends MemberAccessException {
}

class RuntimeException extends MyException {
}

class IllegalArgumentException extends RuntimeException {
}

final class NotStringException extends IllegalArgumentException {
}

final class NotCharacterException extends IllegalArgumentException {
}

final class DivisionByZero extends IllegalArgumentException {
}

class NotNumberException extends IllegalArgumentException {
}

final class NotIntegerException extends NotNumberException {
}

final class NotDoubleException extends NotNumberException {
}

final class OverMaxException extends IllegalArgumentException {
}

final class UnderMinException extends IllegalArgumentException {
}


class IOException extends RuntimeException {
}

final class FileNotFoundException extends IOException {
}

final class FileNotReadableException extends IOException {
}

final class FileNotWritableException extends IOException {
}

class NullPointerException extends RuntimeException {
}


// Boot exception
final class BootstrapException extends MyException {
}

?>