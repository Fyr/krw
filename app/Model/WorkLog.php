<?
App::uses('AppModel', 'Model');
App::uses('SiteArticle', 'Model');
App::uses('WikiArticle', 'Model');
class WorkLog extends AppModel {
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
			} else if ($old_article && $new_article && array_diff_assoc($old_article, $new_article)) {
				$work_type = WorkLog::UPDATED;
			}
		}
		if ($work_type) {
			$object_id = $new_article['id'];
			$this->save(compact('work_type', 'object_type', 'object_id'));
		}
	}

	public function getLogs($count = 0) {
		$fields = array('id', 'DATE(created) AS date_created', 'work_type', 'object_type', 'object_id', 'comment');
		$order = array('date_created' => 'desc', 'object_type' => 'desc', 'object_id' => 'asc', 'work_type' => 'asc', 'id' => 'desc');
		$aLogs = $this->find('all', compact('fields', 'order'));

		// sort logs by priority
		$aSorted = array();
		$article_ids = array();
		foreach($aLogs as $log) {
			$created = $log[0]['date_created'];
			if (!isset($aSorted[$created])) {
				$aSorted[$created] = array();
			}

			$object_type = $log['WorkLog']['object_type'];
			$object_id = $log['WorkLog']['object_id'];
			$object_type_id = $object_type.'_'.$object_id;
			if (!isset($aSorted[$created][$object_type_id])) {
				$aSorted[$created][$object_type_id] = array();
			}

			$work_type = $log['WorkLog']['work_type'];
			if (!isset($aSorted[$created][$object_type_id][$work_type])) {
				$aSorted[$created][$object_type_id][$work_type] = array();
			}
			$aSorted[$created][$object_type_id][$work_type][] = $log['WorkLog'];

			if ($object_type !== 'WorkLog') {
				if (!isset($article_ids[$object_type])) {
					$article_ids[$object_type] = array();
				}
				if (!isset($article_ids[$object_type][$object_id])) {
					$article_ids[$object_type][$object_id] = $object_id;
				}
			}
		}

		// extract logs by priority
		$aLogs = array();
		$_count = 0;
		foreach($aSorted as $created => $_object_types) {
			if (!isset($aLogs[$created])) {
				$_count++;
				if ($count && $_count > $count) {
					break;
				}
				$aLogs[$created] = array();
			}

			foreach($_object_types as $object_type_id => $_logs) {
				list($object_type, $object_id) = explode('_', $object_type_id);

				$logs = array_values($_logs);
				if ($object_type === 'WorkLog') {
					$aLogs[$created][self::DEV_WORK] = array_values($logs[0]); // keep all logs
				} else {
					$log = array_shift(array_values($logs[0])); // keep prior log
					$work_type = $log['work_type'];
					if (!isset($aLogs[$created][$work_type])) {
						$aLogs[$created][$work_type] = array();
					}
					$aLogs[$created][$work_type][] = $log;
				}
			}
		}

		// get articles for logs
		foreach($article_ids as $object_type => $object_ids) {
			$this->{$object_type} = $this->loadModel($object_type);
			foreach($object_ids as $id) {
				$article_ids[$object_type][$id] = $this->{$object_type}->findById($id);
			}
		}
		return array('logs' => $aLogs, 'articles' => $article_ids);
	}
}
