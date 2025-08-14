<?php

class PerchPolls_Response extends PerchAPI_Base
{
    protected $table        = 'poll_responses';
    protected $pk           = 'poll_responseID';
    protected $index_table  = 'poll_index';
    protected $namespace    = 'poll';
    protected $event_prefix = 'poll.response';

}
