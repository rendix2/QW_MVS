<?php

namespace QW\FW\Boot;

class ProgrammerExceptions extends \Exception {
}

class UnsupportedOperationException extends ProgrammerExceptions {
}

class MemberAccessException extends ProgrammerExceptions {
}

final class PrivateConstructException extends MemberAccessException {
}

class RuntimeException extends \Exception {
}

class IllegalArgumentException extends RuntimeException {
}

final class NotStringException extends IllegalArgumentException {
}

final class NotCharacterException extends IllegalArgumentException {
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

?>