    /**
    * Method of <<name>>
    *
    * @param ServerRequestInterface $request
    * @param ResponseInterface $response
    *
    * @access public
    * @return $output
    */    
    public function <<name>>(ServerRequestInterface $request, ResponseInterface $response)
    {   
        return Outputs::output($response, Outputs::success([]));
    }  