<?php

namespace QW\Libs;

use QW\FW\Basic\IllegalArgumentException;
use QW\FW\Basic\NullPointerException;

class LanguageAdmin extends Language
{

    const PREFIX_NAME = '/langAdmin';
    const PREFIX_NAME_META = '/langAdminMeta';

    private $langName, $langAdmin, $metaAdmin;

    public function __construct($langName)
    {
        if ($langName == null)
            throw new NullPointerException();

        if (!preg_match('#^[A-Z]*$#', $langName))
            throw new IllegalArgumentException();

        $this->langName = $langName;

        if (!file_exists(self::PATH . $this->langName . self::PREFIX_NAME . $this->langName . self::EXT))
            throw new LanguageException('Neexistující jazykový balíček administrace: <strong>' . $langName . '</strong>.');

        if (!file_exists(self::PATH . $this->langName . self::PREFIX_NAME_META . $this->langName . self::EXT))
            throw new LanguageException('Neexistující jazykový balíček meta dat administrace: <strong>' . $langName . '</strong>.');

        $this->langAdmin = parse_ini_file(self::PATH . $this->langName . self::PREFIX_NAME . $this->langName . self::EXT);
        $this->metaAdmin = parse_ini_file(self::PATH . $this->langName . self::PREFIX_NAME_META . $this->langName . self::EXT);
    }

    public function __destruct()
    {
        parent::__destruct();
        $this->langName = null;
        $this->langAdmin = null;
        $this->metaAdmin = null;
    }

    public function languageGetPack()
    {
        return $this->langAdmin;
    }

    public function languageGetMetaPack()
    {
        return $this->metaAdmin;
    }
}