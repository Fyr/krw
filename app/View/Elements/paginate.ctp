<?
	if ($this->Paginator->numbers()) {
		$this->Paginator->options(array('url' => array(
			'objectType' => $this->request->param('objectType'),
			'category' => $this->request->param('category'),
			'?' => $this->request->query
		)));
?>
<div class="pagination">
	Страницы: <?=$this->Paginator->numbers(array('separator' => ' '))?>
</div>
		<!-- div class="pagination">
			Страницы:
			<span class="current">1</span>
			<span><a href="/news/page/2">2</a></span>
			<span><a href="/news/page/3">3</a></span>
		</div-->
<?
	}
?>