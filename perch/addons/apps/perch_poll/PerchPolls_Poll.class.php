<?php

class PerchPolls_Poll extends PerchAPI_Base
{
    protected $table        = 'polls';
    protected $pk           = 'pollID';

    protected $index_table  = 'poll_index';
    protected $event_prefix = 'poll.poll';

}
