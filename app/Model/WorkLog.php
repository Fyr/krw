<?
App::uses('AppModel', 'Model');
class WorkLog extends Model {
	const DEV_WORK =  0;
	const PUBLISHED = 1;
	const CREATED = 2;
	const UPDATED = 3;

	public function saveLog($object_type, $old_article, $new_article) {
		$work_type = 0;
		$old_article = ($old_article) ? $old_article : array();
		if (in_array($object_type, array('SiteArticle', 'WikiArticle'))) {

			if (!Hash::get($old_article, 'published') && Hash::get($new_article, 'published')) {
				$work_type = WorkLog::PUBLISHED;
			} else if (!$old_article && $new_article) {
				$work_type = WorkLog::CREATED;
			} else if ($old_article && $new_article) {
				// exclude modified fields
				unset($old_article['modified']);
				unset($new_article['modified']);
				$diff = array_diff_assoc($old_article, $new_article);
				if ($diff) {
					$work_type = WorkLog::UPDATED;
				}
			}
			// fdebug(compact('work_type', 'old_article', 'new_article', 'diff'));
		}
		if ($work_type) {
			$object_id = $new_article['id'];
			$this->save(compact('work_type', 'object_type', 'object_id'));
		}
	}
}
