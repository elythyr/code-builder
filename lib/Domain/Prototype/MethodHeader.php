<?php

namespace Phpactor\CodeBuilder\Domain\Prototype;

use Phpactor\CodeBuilder\Domain\Prototype\Lines;
use Phpactor\CodeBuilder\Domain\Prototype\MethodBody;

final class MethodHeader extends Prototype
{
    const IS_STATIC = 1;
    const IS_ABSTRACT = 2;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Visibility
     */
    private $visibility;

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @var ReturnType
     */
    private $returnType;

    /*
     * @var Docblock
     */
    private $docblock;

    /**
     * @var bool
     */
    private $isStatic;

    /**
     * @var bool
     */
    private $isAbstract;

    /**
     * @var MethodBody
     */
    private $body;

    public function __construct(
        string $name,
        Visibility $visibility = null,
        Parameters $parameters = null,
        ReturnType $returnType = null,
        Docblock $docblock = null,
        int $modifierFlags = 0,
        MethodBody $body = null
    )
    {
        $this->name = $name;
        $this->visibility = $visibility ?: Visibility::public();
        $this->parameters = $parameters ?: Parameters::empty();
        $this->returnType = $returnType ?: ReturnType::none();
        $this->docblock = $docblock ?: Docblock::none();
        $this->isStatic = $modifierFlags & self::IS_STATIC;
        $this->isAbstract = $modifierFlags & self::IS_ABSTRACT;
        $this->body = $body ?: MethodBody::empty();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function visibility(): Visibility
    {
        return $this->visibility;
    }

    public function parameters(): Parameters
    {
        return $this->parameters;
    }

    public function returnType(): ReturnType
    {
        return $this->returnType;
    }

    public function docblock(): Docblock
    {
        return $this->docblock;
    }

    public function isStatic(): bool
    {
        return $this->isStatic;
    }

    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    public function body(): MethodBody
    {
        return $this->body;
    }
}
