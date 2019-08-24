<?php

namespace AdvancedPrint;

class AdvancedPrint
{
    /**
     * Terminal width
     *
     * @var int
     */
    private static $trm_width;

    /**
     * Color escape sequences
     * 
     * @var array
     */
    private static $color_esc = array(
        'NC'            => "\e[0m",       # Text Reset
        // Common colors
        'Black'         => "\e[0;30m",    # Black
        'Red'           => "\e[0;31m",    # Red
        'Green'         => "\e[0;32m",    # Green
        'Yellow'        => "\e[0;33m",    # Yellow
        'Blue'          => "\e[0;34m",    # Blue
        'Purple'        => "\e[0;35m",    # Purple
        'Cyan'          => "\e[0;36m",    # Cyan
        'White'         => "\e[0;37m",    # White / Light Gray

        // Bold colors
        'BBlack'        => "\e[1;30m",    # Bold Black
        'BRed'          => "\e[1;31m",    # Bold Red
        'BGreen'        => "\e[1;32m",    # Bold Green
        'BYellow'       => "\e[1;33m",    # Bold Yellow
        'BBlue'         => "\e[1;34m",    # Bold Blue
        'BPurple'       => "\e[1;35m",    # Bold Purple
        'BCyan'         => "\e[1;36m",    # Bold Cyan
        'BWhite'        => "\e[1;37m",    # Bold White
        
        // Dim colors
        'DBlack'        => "\e[2;30m",    # Dim Black
        'DRed'          => "\e[2;31m",    # Dim Red
        'DGreen'        => "\e[2;32m",    # Dim Green
        'DYellow'       => "\e[2;33m",    # Dim Yellow
        'DBlue'         => "\e[2;34m",    # Dim Blue
        'DPurple'       => "\e[2;35m",    # Dim Purple
        'DCyan'         => "\e[2;36m",    # Dim Cyan
        'DWhite'        => "\e[2;37m",    # Dim White

        'CRed'          => "\e[3;31m",    # Italic Red
        'TRed'          => "\e[9;31m",    # Through Red  

        // Underline
        'UBlack'        => "\e[4;30m",    # Underline Black
        'URed'          => "\e[4;31m",    # Underline Red
        'UGreen'        => "\e[4;32m",    # Underline Green
        'UYellow'       => "\e[4;33m",    # Underline Yellow
        'UBlue'         => "\e[4;34m",    # Underline Blue
        'UPurple'       => "\e[4;35m",    # Underline Purple
        'UCyan'         => "\e[4;36m",    # Underline Cyan
        'UWhite'        => "\e[4;37m",    # Underline White

        // Background
        'On_Black'      => "\e[40m",      # Background Black
        'On_Red'        => "\e[41m",      # Background Red
        'On_Green'      => "\e[42m",      # Background Green
        'On_Yellow'     => "\e[43m",      # Background Yellow
        'On_Blue'       => "\e[44m",      # Background Blue
        'On_Purple'     => "\e[45m",      # Background Purple
        'On_Cyan'       => "\e[46m",      # Background Cyan
        'On_White'      => "\e[47m",      # Background White / Light gray

        // High Intense
        'IBlack'        => "\e[0;90m",    # Black / Dark gray
        'IRed'          => "\e[0;91m",    # Red
        'IGreen'        => "\e[0;92m",    # Green
        'IYellow'       => "\e[0;93m",    # Yellow
        'IBlue'         => "\e[0;94m",    # Blue
        'IPurple'       => "\e[0;95m",    # Purple
        'ICyan'         => "\e[0;96m",    # Cyan
        'IWhite'        => "\e[0;97m",    # White

        // Bright High Intense
        'BIBlack'       => "\e[1;90m",    # Black
        'BIRed'         => "\e[1;91m",    # Red
        'BIGreen'       => "\e[1;92m",    # Green
        'BIYellow'      => "\e[1;93m",    # Yellow
        'BIBlue'        => "\e[1;94m",    # Blue
        'BIPurple'      => "\e[1;95m",    # Purple
        'BICyan'        => "\e[1;96m",    # Cyan
        'BIWhite'       => "\e[1;97m",    # White

        // High Intense Background
        'On_IBlack'     => "\e[0;100m",   # Black
        'On_IRed'       => "\e[0;101m",   # Red
        'On_IGreen'     => "\e[0;102m",   # Green
        'On_IYellow'    => "\e[0;103m",   # Yellow
        'On_IBlue'      => "\e[0;104m",   # Blue
        'On_IPurple'    => "\e[0;105m",   # Purple
        'On_ICyan'      => "\e[0;106m"    # Cyan
    );

    /**
     * Replace colore code for escape sequence
     *
     * @param string $msg
     * @return string
     */
    private static function parse_colors(string $msg): string
    {
        // Matches color code in the string
        preg_match_all("/\[([a-z_A-Z]+)\]/", $msg, $matches);
        
        $patterns = array_shift($matches);
        $colors   = array_shift($matches);
        
        foreach ($patterns as $key => $value) {
            $esc = self::$color_esc[$colors[$key]];
            $msg = str_replace($value, $esc, $msg);
        }
        
        return $msg;
    }


    /**
     * Print colored string
     *
     * @param string $msg
     * @return void
     */
    public static function print(string $msg, bool $new_line = true)
    {
        echo self::parse_colors($msg) . self::$color_esc['NC'] . ($new_line ? PHP_EOL : '');
    }

}