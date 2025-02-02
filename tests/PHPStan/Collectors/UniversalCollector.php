<?php declare(strict_types = 1);

namespace PHPStan\Collectors;

use PhpParser\Node;
use PHPStan\Analyser\Scope;

/**
 * @template TNodeType of Node
 * @implements Collector<TNodeType>
 */
class UniversalCollector implements Collector
{

	/** @phpstan-var class-string<TNodeType> */
	private $nodeType;

	/** @var (callable(TNodeType, Scope): mixed) */
	private $processNodeCallback;

	/**
	 * @param class-string<TNodeType> $nodeType
	 * @param (callable(TNodeType, Scope): mixed) $processNodeCallback
	 */
	public function __construct(string $nodeType, callable $processNodeCallback)
	{
		$this->nodeType = $nodeType;
		$this->processNodeCallback = $processNodeCallback;
	}

	public function getNodeType(): string
	{
		return $this->nodeType;
	}

	/**
	 * @param TNodeType $node
	 * @return mixed
	 */
	public function processNode(Node $node, Scope $scope)
	{
		$callback = $this->processNodeCallback;
		return $callback($node, $scope);
	}

}
