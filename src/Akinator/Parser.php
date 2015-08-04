<?php

namespace Minneola\TestFoo\Akinator;

/**
 * Class Parser
 * @package Minneola\TestFoo\Akinator
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Parser
{

	private $res = '';

	protected function parseForEach($res)
	{
		return preg_replace(
			['/@foreach\((.*?)\)/', '/@endforeach/'],
			['<?php foreach($1): ?>', '<?php endforeach; ?>'],
			$res
		);
	}

	protected function parseWhile($res)
	{
		return preg_replace(
			['/@while\((.*?)\)/', '/@endwhile/'],
			['<?php while($1): ?>', '<?php endwhile; ?>'],
			$res
		);
	}

	protected function parseFor($res)
	{
		return preg_replace(
			['/@for\((.*?)\)/', '/@endfor/'],
			['<?php for($1): ?>', '<?php endfor; ?>'],
			$res
		);
	}

	protected function parseIf($res)
	{
		return preg_replace(
			['/@if\((.*?)\)/', '/@elseif\((.*?)\)/', '/@else/', '/@endif/'],
			['<?php if($1): ?>', '<?php elseif($1): ?>', '<?php endif; ?>', '<?php else: ?>'],
			$res
		);
	}

	protected function parseSpecials($res)
	{
		return preg_replace(
			['/@break/', '/@continue/', '/\{\{\!(.*?)\!\}\}/', '/\{\{(.*?)\}\}/'],
			['<?php break; ?>', '<?php continue; ?>','<?php echo($1); ?>', '<?php echo(htmlspecialchars($1)); ?>'],
			$res
		);
	}

	public function __construct($res)
	{
		$this->res = $this->parseWhile(
			$this->parseFor(
				$this->parseIf($this->parseSpecials($this->parseForEach($res)))
			)
		);
	}

	public function __toString()
	{
		return $this->res;
	}

} 