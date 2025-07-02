<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Table_Articles extends loresite_Table
{
    protected $Tables;

    public function __construct()
    {
        $this->Tables = new loresite_Table;
    }

    /**
     * Generates the card header for the HTML table.
     * 
     * @param string $table_name The name of the table.
     * @return string The HTML representation of the card header.
     */
    public function generate_card_header($table_name) 
    {
        $html = '<div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            ' . $table_name . '</a>' . '
        </div>
        <div class="card-body">
        <table id="datatablesSimple">';

        return $html;
    }

     /**
     * Generates the table body for the HTML table.
     * 
     * @param array $data An array containing arrays with the data for the table rows.
     * @return string The HTML representation of the table body.
     */
    public function generate_table_body($data) 
    {
        $html = '<tbody>';
        foreach ($data as $row) 
        {
            $html .= '<tr>';
            $counter = 0;
            foreach ($row as $cell) 
            {
                if ($counter === 1) {
                    //the link to the player formn page
                    $html .= '<td><a href="index.php?page='.$cell.'">' . $cell . '</a></td>';
                } else {
                    $html .= '<td>' . $cell . '</td>';
                }

                $counter++;
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        return $html;
    }
}

?>