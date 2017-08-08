<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingDirsException;

class Pathname
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
     * Pathname constructor.
     * @param array ...$dirs
     * @throws MissingDirsException
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
            $this->path = realpath(join(DIRECTORY_SEPARATOR, $this->dirs));
        }
        return $this->path;
    }
}