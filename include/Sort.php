<?php
class Sort {
	function title($a, $b)
	{
	    return strcmp($a->title,$b->title);
	}

	function sort_it($list,$sorttype)
	{
		usort($list,array($this,$sorttype));
		return $list;
	}
}

?>