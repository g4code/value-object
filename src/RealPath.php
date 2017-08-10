<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingDirsException;
use G4\ValueObject\Exception\PathDoesNotExist;

class RealPath
{

    /**
     * @var string
     */
    private $path;

    /**
     * RealPath constructor.
     * @param array ...$dirs
     * @throws PathDoesNotExist
     */
    public function __construct(...$dirs)
    {
        $this->path = realpath(RelativePath::join($dirs));
        if ($this->path === false) {
            throw new PathDoesNotExist(RelativePath::join($dirs));
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
}