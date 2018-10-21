<?php
class Sort {
	function title($a, $b)
	{
	    return strcmp($a->title,$b->title);
	}

	function sort_it($list,$sorttype)
	{
		uasort($list,array($this,$sorttype));
		return $list;
	}
}

?>