<?php

class PerchPolls_Answer extends PerchAPI_Base
{
    protected $table        = 'poll_answer';
    protected $pk           = 'answerID';
    protected $index_table  = 'poll_index';
    protected $namespace    = 'poll';
    protected $event_prefix = 'poll.answer';

}
