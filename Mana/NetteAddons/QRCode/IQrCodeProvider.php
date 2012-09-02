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
 */
interface IQrCodeProvider
{
	public function getImageUrl($stringToEncode);

	public function setSize($size);
}