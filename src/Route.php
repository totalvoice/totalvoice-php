<?php
namespace TotalVoice;

class Route implements RouteInterface
{
    /**
     * @var array
     */
    private $values;

    /**
     * Route constructor.
     * @param array $values
     */
    public function __construct($values = [])
    {
        $this->values = $values;
    }

    /**
     * Monta a URL de acordo com os parâmetros
     * @return string
     * Build path URL
     */
    public function build()
    {
        $count = count($this->values);
        $pattern = '';
        for($i = 0; $i < $count; $i++) {
            $pattern .= '%s';
        }
        return vsprintf($pattern, $this->values);
    }
}