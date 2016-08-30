<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Akinator;

/**
 * Class Parser
 * @package Minneola\TestFoo\Akinator
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Parser
{

    /**
     * @var mixed|string
     */
    private $res = '';

    /**
     * @param $res
     * @return mixed
     */
    protected function parseForEach($res)
	{
		return preg_replace(
			['/@foreach\((.*?)\)/', '/@endforeach/'],
			['<?php foreach($1): ?>', '<?php endforeach; ?>'],
			$res
		);
	}

    /**
     * @param $res
     * @return mixed
     */
    protected function parseWhile($res)
	{
		return preg_replace(
			['/@while\((.*?)\)/', '/@endwhile/'],
			['<?php while($1): ?>', '<?php endwhile; ?>'],
			$res
		);
	}

    /**
     * @param $res
     * @return mixed
     */
    protected function parseFor($res)
	{
		return preg_replace(
			['/@for\((.*?)\)/', '/@endfor/'],
			['<?php for($1): ?>', '<?php endfor; ?>'],
			$res
		);
	}

    /**
     * @param $res
     * @return mixed
     */
    protected function parseIf($res)
	{
		return preg_replace(
			['/@if\((.*?)\)/', '/@elseif\((.*?)\)/', '/@else/', '/@endif/'],
			['<?php if($1): ?>', '<?php elseif($1): ?>', '<?php endif; ?>', '<?php else: ?>'],
			$res
		);
	}

    /**
     * @param $res
     * @return mixed
     */
    protected function parseInclude($res)
	{
		return preg_replace(
			['/@include\((.*?)\)/'],
			['<?php @require(\App::rootPath()."/views/$1.php"); ?>'],
			$res
		);
	}

    /**
     * @param $res
     * @return mixed
     */
    protected function parseSpecials($res)
	{
		return preg_replace(
			['/@break/', '/@continue/', '/\{\{\!(.*?)\!\}\}/', '/\{\{(.*?)\}\}/'],
			['<?php break; ?>', '<?php continue; ?>','<?php echo($1); ?>', '<?php echo(htmlspecialchars($1)); ?>'],
			$res
		);
	}

    /**
     * Parser constructor.
     * @param $res
     */
    public function __construct($res)
	{
		$this->res = $this->parseWhile(
			$this->parseFor($this->parseInclude(
					$this->parseIf($this->parseSpecials($this->parseForEach($res)))
				))
		);
	}

    /**
     * @return mixed|string
     */
    public function __toString()
	{
		return $this->res;
	}

} 