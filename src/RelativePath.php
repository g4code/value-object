<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingDirsException;

class RelativePath implements StringInterface
{

    /**
     * @var array
     */
    private $dirs;

    /**
     * @var string
     */
    private $path;


    /**
     * RelativePath constructor.
     * @param array ...$dirs
     */
    public function __construct(...$dirs)
    {
        if (empty($dirs)) {
            throw new MissingDirsException();
        }
        $this->dirs = $dirs;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->path === null) {
            $this->path = self::join($this->dirs);
        }
        return $this->path;
    }

    /**
     * @param array $dirs
     * @return string
     */
    public static function join(array $dirs)
    {
        return join(DIRECTORY_SEPARATOR, $dirs);
    }
}
