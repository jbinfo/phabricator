<?php

final class PhabricatorAuditReplyHandler
  extends PhabricatorApplicationTransactionReplyHandler {

  public function validateMailReceiver($mail_receiver) {
    if (!($mail_receiver instanceof PhabricatorRepositoryCommit)) {
      throw new Exception(
        pht(
          'Mail receiver is not a %s!',
          'PhabricatorRepositoryCommit'));
    }
  }

  public function getObjectPrefix() {
    // TODO: This conflicts with Countdown and will probably need to be
    // changed eventually.
    return 'C';
  }

}
