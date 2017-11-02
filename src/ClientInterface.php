<?php
namespace TotalVoice;

/**
 * ClientInterface
 */
interface ClientInterface
{
    /**
     * @param RouteInterface $route
     * @param array $params
     * @return string
     */
    public function get(RouteInterface $route, $params = []);

    /**
     * @param RouteInterface $route
     * @param $data
     * @return string
     */
    public function post(RouteInterface $route, $data);

    /**
     * @param RouteInterface $route
     * @param $data
     * @return string
     */
    public function put(RouteInterface $route, $data);

    /**
     * @param RouteInterface $route
     * @return string
     */
    public function delete(RouteInterface $route);
}