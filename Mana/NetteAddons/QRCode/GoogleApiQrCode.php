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
 * @author Pavel Kouřil
 *
 * @property int $size
 * @property string $errorCorrectionLevel
 * @property int $margin
 */
class GoogleAPIQrCode extends \Nette\Object implements IQrCodeProvider
{

	const ERROR_CORRECTION_L = "L";

	const ERROR_CORRECTION_M = "M";

	const ERROR_CORRECTION_Q = "Q";

	const ERROR_CORRECTION_H = "H";

	/**
	 * @var int
	 */
	private $size = 150;

	/**
	 * @var string
	 */
	private $errorCorrectionLevel = "L";

	/**
	 * @var int
	 */
	private $margin = 0;

	public function __construct($size = 150, $errorCorrectionLevel = "L", $margin = 0)
	{
		$this->size = $size;
		$this->errorCorrectionLevel = $errorCorrectionLevel;
		$this->margin = $this->margin;
	}

	/**
	 * @param string $errorCorrectionLevel
	 *
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
	 *
	 * @throws \Nette\ArgumentOutOfRangeException
	 */
	public function setSize($size)
	{
		if ((int)$size <= 0) {
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
	 * @param $stringToEncode
	 *
	 * @return string
	 */
	public function getImageUrl($stringToEncode)
	{
		return "http://chart.apis.google.com/chart?chs=" .
			$this->size . "x" . $this->size . "&cht=qr&chld=" .
			$this->errorCorrectionLevel . "|" . $this->margin . "&chl="
			. urlencode($stringToEncode);
	}

}