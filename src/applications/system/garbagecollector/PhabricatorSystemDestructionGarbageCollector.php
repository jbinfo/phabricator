<?php

final class PhabricatorSystemDestructionGarbageCollector
  extends PhabricatorGarbageCollector {

  public function collectGarbage() {
    $ttl = phutil_units('90 days in seconds');

    $table = new PhabricatorSystemDestructionLog();
    $conn_w = $table->establishConnection('w');

    queryfx(
      $conn_w,
      'DELETE FROM %T WHERE epoch < %d LIMIT 100',
      $table->getTableName(),
      time() - $ttl);

    return ($conn_w->getAffectedRows() == 100);
  }

}
