<?php

/**
 * This file is part of Mana
 *
 * Copyright (C) 2012 Pavel Kouřil (http://pavelkouril.cz)
 *
 * Distributed under MIT License
 */
namespace Mana\NetteAddons\QrCode;

use Nette\Utils\Html;

/**
 * @author Pavel Kouřil
 */
class QrCodeComponent extends \Nette\Application\UI\Control
{
	/**
	 * @var IQrCodeProvider
	 */
	private $qrCodeProvider;

	public function __construct(IQrCodeProvider $qrCodeProvider)
	{
		$this->qrCodeProvider = $qrCodeProvider;
		parent::__construct();
	}

	public function render($stringToEncode, $size = NULL)
	{
		if ($size != NULL) {
			$this->qrCodeProvider->size = $size;
		}

		echo Html::el("img", array(
			'src' => $this->qrCodeProvider->getImageUrl($stringToEncode),
			'title' => $stringToEncode,
			'alt' => $stringToEncode,
		));
	}
}