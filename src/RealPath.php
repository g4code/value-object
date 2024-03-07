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
     * @param string ...$parts
     * @throws PathDoesNotExist
     */
    public function __construct(...$parts)
    {
        $realpath = realpath(RelativePath::join($parts));
        if ($realpath === false) {
            throw new PathDoesNotExist(RelativePath::join($parts));
        }
        $this->path = $realpath;
    }

    /**
     * @param $onePart
     * @return RealPath
     */
    public function append($onePart)
    {
        return new self($this->path, $onePart);
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
    public function diff(RealPath $pathname)
    {
        $diff = str_replace((string) $pathname, '', $this->__toString());
        return new StringLiteral($diff);
    }
}
