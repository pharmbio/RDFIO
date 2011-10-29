<?php

class RDFIOARC2Parser extends RDFIOParser {
	
	protected $mInputType = null;

	public function __construct() {
		parent::__construct();
	}
	
	public function execute() {
		switch ( $this->getInput()->getDataType() ) {
			case ( 'rdfxml' ): 
				$this->mExternalParser = ARC2::getRDFXMLParser();
				break;
			case ( 'turtle' ):
				$this->mExternalParser = ARC2::getTurtleParser();
			default:
				// TODO: Add some error message!
		}
		
		# Execute the external parser
		$this->mExternalParser->parseData( $this->getInput()->getData() );
		
		# Collect results
		$arc2TriplesData = new RDFIORawData();
		$arc2TriplesData->setData( $this->mExternalParser->getTriples() );
		$arc2TriplesData->setDataType( 'arc2triples' );
		
		// Send $arc2TriplesData to a ARC2ToSMWParser
		
		# $this->setResults(  ); 
	}
}
