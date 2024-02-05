<?php

namespace Drupal\school\Entity;

use Drupal\address\AddressInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Defines the interface for schools.
 */
interface SchoolInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface
{

    /**
     * Gets the school name.
     *
     * @return string
     *   The school name.
     */
    public function getName();

    /**
     * Sets the school name.
     *
     * @param string $name
     *   The school name.
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Gets the school logo.
     *
     * @return string
     *   The path to the school logo.
     */
    public function getLogo();

    /**
     * Sets the school logo.
     *
     * @param string $logo
     *   The path to the school logo.
     */
    public function setLogo($logo);
    /**
     * Gets the school email.
     *
     * @return string
     *   The school email.
     */
    public function getEmail();

    /**
     * Gets the school email formatted as email 'From' header.
     *
     * Example: 'My school <myschool@example.com>'
     *
     * @return string
     *   The school name, with email wrapped in angle brackets.
     */
    public function getEmailFromHeader();

    /**
     * Sets the school email.
     *
     * @param string $mail
     *   The school email.
     *
     * @return $this
     */
    public function setEmail($mail);

    /**
     * Gets the school address.
     *
     * @return \Drupal\address\AddressInterface
     *   The school address.
     */
    public function getAddress();

    /**
     * Sets the school address.
     *
     * @param \Drupal\address\AddressInterface $address
     *   The school address.
     *
     * @return $this
     */
    public function setAddress(AddressInterface $address);

    /**
     * Gets the school registration number.
     *
     * @return string
     *   The school registration number.
     */
    public function getRegistrationNumber();

    /**
     * Sets the school registration_number.
     *
     * @param int $registration_number
     *   The school registration_number.
     *
     * @return $this
     */
    public function setRegistrationNumber($registration_number);

    /**
     * Gets the school phone number.
     *
     * @return string
     *   The school phone number.
     */
    public function getPhoneNumber();

    /**
     * Sets the school phone number.
     *
     * @param int $phone_number
     *   The school phone number.
     *
     * @return $this
     */
    public function setPhoneNumber($phone_number);

    /**
     * Gets the school mobile number.
     *
     * @return string
     *   The school mobile number.
     */
    public function getMobile();

    /**
     * Sets the school mobile number.
     *
     * @param int $mobile
     *   The school mobile number.
     *
     * @return $this
     */
    public function setMobile($mobile);

    /**
     * Gets the school established date.
     *
     * @return string
     *   The school established date.
     */
    public function getEstablishedDate();

    /**
     * Sets the school established date.
     *
     * @param int $established_date
     *   The school established date.
     *
     * @return $this
     */
    public function setEstablishedDate($established_date);

    /**
     * Gets the school type.
     *
     * @return string
     *   The school type.
     */
    public function getType();

    /**
     * Sets the school type.
     *
     * @param int $type
     *   The school type.
     *
     * @return $this
     */
    public function setType($type);

    /**
     * Gets the school board.
     *
     * @return string
     *   The school school board.
     */
    public function getBoard();

    /**
     * Sets the school board.
     *
     * @param int $board
     *   The school board.
     *
     * @return $this
     */
    public function setBoard($board);

    /**
     * Gets the school recognize.
     *
     * @return string
     *   The school school recognize.
     */
    public function getRecognize();

    /**
     * Sets the school recognize.
     *
     * @param int $recognize
     *   The school recognize.
     *
     * @return $this
     */
    public function setRecognize($recognize);

    /**
     * Gets the school pattern.
     *
     * @return string
     *   The school school pattern.
     */
    public function getPattern();

    /**
     * Sets the school pattern.
     *
     * @param int $pattern
     *   The school pattern.
     *
     * @return $this
     */
    public function setPattern($pattern);

    /**
     * Gets the school timezone.
     *
     * Used when determining promotion and tax availability.
     *
     * @return string
     *   The timezone.
     */
    //public function getTimezone();

    /**
     * Sets the school timezone.
     *
     * @param string $timezone
     *   The timezone.
     *
     * @return $this
     */
    //public function setTimezone($timezone);

    /**
     * Gets the school creation timestamp.
     *
     * @return int
     *   The school creation timestamp.
     */
    public function getCreatedTime();

    /**
     * Sets the school creation timestamp.
     *
     * @param int $timestamp
     *   The school creation timestamp.
     *
     * @return $this
     */
    public function setCreatedTime($timestamp);
}
