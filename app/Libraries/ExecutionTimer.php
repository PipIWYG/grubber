<?php namespace App\Libraries;

/**
 * ExecutionTimer component to track execution processes
 *
 * @author Quintin Stoltz <quintin@rhinoafrica.com>
 */
class ExecutionTimer
{
    /**
     * @var bool Has Execution Started
     */
    private $execution_started = false;
    
    /**
     * @var bool Has Execution Completed
     */
    private $execution_completed = false;
    
    /**
     * @var date Execution Start Time
     */
    private $execution_start_time;
    
    /**
     * @var date Execution End Time
     */
    private $execution_completed_time;
    
    /**
     * @var date Execution Start Time Float
     */
    private $execution_start_time_f;
    
    /**
     * @var date Execution End Time Float
     */
    private $execution_completed_time_f;
    
    /**
     * Start Execution Tracking
     *
     * @return void
     */
    private function startExecutionTracking()
    {
        // Set Start Time
        $this->execution_start_time = microtime(false);
        
        // Set Start Time Float
        $this->execution_start_time_f = microtime(true);
    }
    
    /**
     * Stop Execution Tracking
     *
     * @return void
     */
    private function stopExecutionTracking()
    {
        // Set End Time
        $this->execution_end_time = microtime(false);
        
        // Set End Time Float
        $this->execution_end_time_f = microtime(true);
    }
    
    /**
     * Initialize Object Properties
     *
     * @return void
     */
    private function initialize()
    {
        // Set Flags
        $this->execution_started = true;
        $this->execution_completed = false;
    }
    
    /**
     * End Object Properties
     *
     * @return void
     */
    private function terminate()
    {
        // Set Flags
        $this->execution_started = false;
        $this->execution_completed = true;
    }
    
    /**
     * Format Date Output
     *
     * @param microtime $time The time to format
     * 
     * @return date Formatted date
     */
    private function format_datetime($time)
    {
        list($usec, $sec) = explode(' ', $time);
        $usec = str_replace("0.", ".", $usec);
        
        // Format
        return date("Y-m-d H:i:s", $sec);
    }
    
    /**
     * Format Execution Time
     *
     * @param microtime $time The time to format
     * @param bool $friendly Format output in a friendly manner
     * 
     * @return string Formatted output
     */
    private function format_execution_time($time, $friendly = true)
    {
        // Calculate Hours, Minutes, Seconds and Milliseconds from $time parameter
        $hours = (int)($minutes = (int)($seconds = (int)($milliseconds = (int)($time * 1000)) / 1000) / 60) / 60;
        
        // Format Hour Output
        $format_hour = $this->formatTimeCap($hours,'hour');
        
        // Format Minute Output
        $format_minute = $this->formatTimeCap(($minutes%60),'minute');
        
        // Format Seconnd Output
        $format_second = $this->formatTimeCap(($seconds%60),'second', true, true);
        
        // Format Millisecond Output
        $format_millisecond = $this->formatTimeCap(rtrim($milliseconds%1000, '0'),'millisecond', false, true);
        
        // Return Formatted Output
        return (($friendly) ? $format_hour.$format_minute.$format_second.$format_millisecond : $hours.':'.($minutes%60).':'.($seconds%60).(($milliseconds===0)?'':'.'.rtrim($milliseconds%1000, '0')));
    }
    
    /**
     * Format Hour, Min, Sec with label
     *
     * @param mixed $input The time to format
     * @param string $label The label to use
     * @param bool $addComma Add comma after output
     * @param bool $displayZero Return a value even if $input is zero
     * 
     * @return string Formatted Output
     */
    private function formatTimeCap($input,$label,$addComma = true, $displayZero = false)
    {
        // Format the label
        $theTimeCap = (($input == 1) ? $label : $label.'s').(($addComma) ? ', ' : '');
        
        // Return
        return (($input > 0 || $displayZero) ? $input.' '.$theTimeCap : '');
    }
    
    /**
     * Get formatted execution time
     *
     * @return string Formatted output of Execution time
     */
    public function ExecutionTime()
    {
        // Chec if Execution start time is set
        if (!$this->execution_start_time)
            $this->Start();
        
        // Chec if Execution end time is set
        if (!$this->execution_end_time)
            $this->Stop();
        
        // Return formatted output
        return $this->format_execution_time(($this->execution_end_time_f - $this->execution_start_time_f)).' ('.$this->format_execution_time(($this->execution_end_time_f - $this->execution_start_time_f), false).')';
    }
    
    /**
     * Start Execution Timer and Initialize Properties
     *
     * @return void
     */
    public function Start()
    {
        // Initialize
        $this->initialize();
        
        // Start Timer
        $this->startExecutionTracking();
    }
    
    /**
     * Stop Execution Timer and Update Properties
     *
     * @return void
     */
    public function Stop()
    {
        // Stop Timer
        $this->stopExecutionTracking();
        
        // Update Properties
        $this->terminate();
    }
    
    /**
     * Get a formatted date for the time Execution Started
     *
     * @return string Formatted date of when Execution Started
     */
    public function DateTimeStarted()
    {
        // Check if start time has been set
        if (!$this->execution_start_time)
            $this->Start();
        
        // Return Formatted Start Time
        return $this->format_datetime($this->execution_start_time);
    }
    
    /**
     * Get a formatted date for the time Execution Ended
     *
     * @return string Formatted date of when Execution Ended
     */
    public function DateTimeEnded()
    {
        // Check if end time has been set
        if (!$this->execution_end_time)
            $this->Stop();
            
        // Return Formatted End Time
        return $this->format_datetime($this->execution_end_time);
    }
}
