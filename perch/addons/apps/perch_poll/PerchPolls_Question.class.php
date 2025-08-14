<?php

class PerchPolls_Question extends PerchAPI_Base
{
    protected $table        = 'poll_question';
    protected $pk           = 'questionID';
    protected $index_table  = 'poll_index';
    protected $namespace    = 'poll';
    protected $event_prefix = 'poll.question';

}
