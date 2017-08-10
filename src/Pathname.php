<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingDirsException;
use G4\ValueObject\Exception\PathDoesNotExist;

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
        $this->path = realpath($this->joinDirs());
        if ($this->path === false) {
            throw new PathDoesNotExist($this->joinDirs());
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }

    /**
     * @param Pathname $pathname
     * @return StringLiteral
     */
    public function diff(Pathname $pathname)
    {
        $diff = str_replace((string) $pathname, '', $this->__toString());
        return new StringLiteral($diff);
    }

    private function joinDirs()
    {
        return join(DIRECTORY_SEPARATOR, $this->dirs);
    }
}