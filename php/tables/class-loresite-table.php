<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Table
{
    public function __construct()
    {
        
    }

    /**
     * Generates an HTML table based on the provided table name, column names, and data.
     * 
     * @param string $table_name The name of the table.
     * @param array $columns An array containing the column names of the table.
     * @param array $data An array containing arrays with the data for the table rows.
     * @return string The HTML representation of the table.
     */
    public function generate_table($table_name, $columns, $data) 
    {
        $html = $this->generate_card_header($table_name);
        $html .= $this->generate_table_header($columns);
        $html .= $this->generate_table_footer($columns);
        $html .= $this->generate_table_body($data);
        $html .= '</table></div></div>';
        return $html;
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
            ' . $table_name . '
        </div>
        <div class="card-body">
        <table id="datatablesSimple">';

        return $html;
    }

    /**
     * Generates the table header for the HTML table.
     * 
     * @param array $columns An array containing the column names of the table.
     * @return string The HTML representation of the table header.
     */
    public function generate_table_header($columns) 
    {
        $html = '<thead><tr>';
        foreach ($columns as $column) 
        {
            $html .= '<th>' . $column . '</th>';
        }
        $html .= '</tr></thead>';
        return $html;
    }

    /**
     * Generates the table footer for the HTML table.
     * 
     * @param array $columns An array containing the column names of the table.
     * @return string The HTML representation of the table footer.
     */
    public function generate_table_footer($columns) 
    {
        $html = '<tfoot><tr>';
        foreach ($columns as $column) 
        {
            $html .= '<th>' . $column . '</th>';
        }
        $html .= '</tr></tfoot>';
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
            foreach ($row as $cell) 
            {
                $html .= '<td>' . $cell . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        return $html;
    }
}