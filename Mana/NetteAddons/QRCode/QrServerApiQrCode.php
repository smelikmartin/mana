<?php

/**
 * This file is part of Mana
 *
 * Copyright (C) 2012 Pavel Kouřil (http://pavelkouril.cz)
 *
 * Distributed under MIT License
 */
namespace Mana\NetteAddons\QrCode;

/**
 *
 * @author Martin Smelik (http://www.marsme.cz) 
 * 
 * @property int $size
 * @property string $errorCorrectionLevel
 * @property int $margin
 * @property int $color
 */
class QrServerApiQrCode extends \Nette\Object implements IQrCodeProvider
{
	const ERROR_CORRECTION_L = "L";
	
	const ERROR_CORRECTION_M = "M";
	
	const ERROR_CORRECTION_Q = "Q";
	
	const ERROR_CORRECTION_H = "H";
	
	
	/**
	 * @var int
	 */
	private $size = 200;

	/**
	 * @var string 
	 */
	private $errorCorrectionLevel = "L";

	/**
	 * @var int 
	 */
	private $margin = 0;

	/**
	 * @var string 
	 */
	private $color = "0-0-0";

	public function __construct($size = 200, $errorCorrrectionLevel = "L", $margin = 0,$color = "0-0-0")
	{
		$this->size = $size;
		$this->errorCorrectionLevel = $errorCorrrectionLevel;
		$this->margin = $margin;
		$this->color = $color;
	}

	/**
	 * @param string $errorCorrectionLevel
	 * @throws \Nette\ArgumentOutOfRangeException 
	 */
	public function setErrorCorrectionLevel($errorCorrectionLevel)
	{
		$constant = get_called_class() . '::ERROR_CORRECTION_' . strtoupper($errorCorrectionLevel);
		if (!defined($constant)) {
			throw new \Nette\ArgumentOutOfRangeException("Value for Error Correction has to be L/H/M/Q");
		} else {
			$this->errorCorrectionLevel = constant($constant);
		}
	}

	/**
	 * @return string 
	 */
	public function getErrorCorrectionLevel()
	{
		return $this->errorCorrectionLevel;
	}

	/**
	 * @param int $size
	 * @throws \Nette\ArgumentOutOfRangeException 
	 */
	public function setSize($size)
	{
		if((int)$size <= 0){
			throw new \Nette\ArgumentOutOfRangeException("Size has to be number bigger than 0!");
		}
		$this->size = (int)$size;
	}

	/**
	 * @return int 
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @param int $margin
	 *
	 * @throws \Nette\ArgumentOutOfRangeException
	 */
	public function setMargin($margin)
	{
		if ((int)$margin <= 0) {
			throw new \Nette\ArgumentOutOfRangeException("Margin has to be number bigger than 0!");
		}
		$this->margin = (int)$margin;
	}

	/**
	 * @return int
	 */
	public function getMargin()
	{
		return $this->margin;
	}

	/**
	 * @param string $color 
	 */
	public function setColor($color)
	{
		$this->color = (string)$color;
	}

	/**
	 * @return string 
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * @param $stringToEncode     *
	 * @return string
	 */
	public function getImageUrl($stringToEncode)
	{
		return "http://api.qrserver.com/v1/create-qr-code/?data=" .
		urlencode($stringToEncode) . "&size=" . $this->size . "x" . $this->size . 
			"&ecc=" . $this->errorCorrectionLevel . "&margin=" . $this->margin .
			"&color=" . $this->color;
	}
}