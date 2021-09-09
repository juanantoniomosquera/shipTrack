<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 */
class Track
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $imo;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $timeStamp;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $coordinates;

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of imo
	 */
	public function getImo()
	{
		return $this->imo;
	}

	/**
	 * Set the value of imo
	 *
	 * @return  self
	 */
	public function setImo($imo)
	{
		$this->imo = $imo;

		return $this;
	}

	/**
	 * Get the value of timeStamp
	 */
	public function getTimeStamp()
	{
		return $this->timeStamp;
	}

	/**
	 * Set the value of timeStamp
	 *
	 * @return  self
	 */
	public function setTimeStamp($timeStamp)
	{
		$this->timeStamp = $timeStamp;

		return $this;
	}

	/**
	 * Get the value of coordinates
	 */
	public function getCoordinates()
	{
		return $this->coordinates;
	}

	/**
	 * Set the value of coordinates
	 *
	 * @return  self
	 */
	public function setCoordinates($coordinates)
	{
		$this->coordinates = $coordinates;

		return $this;
	}
}
