<?
App::uses('AppModel', 'Model');
class Snapshot extends AppModel {

    // private function _

    public function getStats() {
        $aRows = $this->find('all', array('order' => array('created' => 'ASC')));
        $start = array_shift($aRows);
        $end = array_pop($aRows);
        $aData = array();

        $aPlayers = unserialize($start['Snapshot']['data']);
        foreach($aPlayers as $i => $player) {
            if ($player['status'] === 'OK') {
                $name = $player['data'][0];
                $start_gs = $player['data'][5];
                $aData[$name] = array(
                    'name' => $name,
                    'start_gs' => $start_gs
                );
            }
        }
        $aPlayers = unserialize($end['Snapshot']['data']);
        foreach($aPlayers as $player) {
            if ($player['status'] === 'OK') {
                $name = $player['data'][0];
                $end_gs = $player['data'][5];

                $aData[$name]['end_gs'] = $end_gs;
                $aData[$name]['gs'] = $end_gs - $aData[$name]['start_gs'];
            }
        }

        return Hash::sort(array_values($aData), '{n}.gs', 'desc', 'numeric');
    }

    public function getStatsReport() {
        $aRows = $this->find('all', array('order' => array('created' => 'ASC')));

        $aData = array();
        $aLabels = array();
        foreach($aRows as $i => $row) {
            $aLabels[] = date('Y-m-d H:i', strtotime($row['Snapshot']['created']));
            $aPlayers = unserialize($row['Snapshot']['data']);
            foreach($aPlayers as $player) {
                if (!$i) { // initialize data for 1st row
                    if ($player['status'] === 'OK') {
                        $name = $player['data'][0];
                        $aData[$name][] = $player['data'][5];
                    }
                } else if ($player['status'] === 'OK') {
                    $name = $player['data'][0];
                    if (isset($aData[$name])) {
                        $aData[$name][] = $player['data'][5];
                    }

                } else {
                    unset($aData[$name]);
                }
            }
        }
        $aGS = array();
        $aTotal = array();
        foreach($aData as $name => $data) {
            $total = 0;
            for($i = 0; $i < count($data); $i++) {
                $gs = $data[$i] - $data[0];
                $aGS[$name][] = $gs;
                $total+= $gs;
            }
        }

        foreach($aLabels as $i => $day) {
            $total = 0;
            foreach($aGS as $name => $data) {
                $total+= $data[$i];
            }
            $aTotal[] = $total;
        }
        return compact('aLabels', 'aGS', 'aTotal');
    }
}
