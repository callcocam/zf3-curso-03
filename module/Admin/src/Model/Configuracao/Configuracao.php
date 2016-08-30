<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Model\Configuracao;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Configuracao extends AbstractModel
{

    protected $title = 'RAZAO SOCIAL';

    protected $email = null;

    protected $facebook = null;

    protected $twitter = null;

    protected $phone = null;

    protected $endereco = null;

    protected $bairro = null;

    protected $fantasia = null;

    protected $cidade = null;

    protected $images = 'default-companies.jpg';

    protected $longetude = null;

    protected $latitude = null;

    /**
     * get title
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get email
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * get facebook
     *
     * @return varchar
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * get twitter
     *
     * @return varchar
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * get phone
     *
     * @return varchar
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * get endereco
     *
     * @return varchar
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * get bairro
     *
     * @return varchar
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * get fantasia
     *
     * @return varchar
     */
    public function getFantasia()
    {
        return $this->fantasia;
    }

    /**
     * get cidade
     *
     * @return int
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * get images
     *
     * @return varchar
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * get longetude
     *
     * @return varchar
     */
    public function getLongetude()
    {
        return $this->longetude;
    }

    /**
     * get latitude
     *
     * @return varchar
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * set title
     *
     * @return varchar
     */
    public function setTitle($title = 'RAZAO SOCIAL')
    {
        $this->title=$title;
        return $this;
    }

    /**
     * set email
     *
     * @return varchar
     */
    public function setEmail($email = null)
    {
        $this->email=$email;
        return $this;
    }

    /**
     * set facebook
     *
     * @return varchar
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook=$facebook;
        return $this;
    }

    /**
     * set twitter
     *
     * @return varchar
     */
    public function setTwitter($twitter = null)
    {
        $this->twitter=$twitter;
        return $this;
    }

    /**
     * set phone
     *
     * @return varchar
     */
    public function setPhone($phone = null)
    {
        $this->phone=$phone;
        return $this;
    }

    /**
     * set endereco
     *
     * @return varchar
     */
    public function setEndereco($endereco = null)
    {
        $this->endereco=$endereco;
        return $this;
    }

    /**
     * set bairro
     *
     * @return varchar
     */
    public function setBairro($bairro = null)
    {
        $this->bairro=$bairro;
        return $this;
    }

    /**
     * set fantasia
     *
     * @return varchar
     */
    public function setFantasia($fantasia = null)
    {
        $this->fantasia=$fantasia;
        return $this;
    }

    /**
     * set cidade
     *
     * @return int
     */
    public function setCidade($cidade = null)
    {
        $this->cidade=$cidade;
        return $this;
    }

    /**
     * set images
     *
     * @return varchar
     */
    public function setImages($images = 'default-companies.jpg')
    {
        $this->images=$images;
        return $this;
    }

    /**
     * set longetude
     *
     * @return varchar
     */
    public function setLongetude($longetude = null)
    {
        $this->longetude=$longetude;
        return $this;
    }

    /**
     * set latitude
     *
     * @return varchar
     */
    public function setLatitude($latitude = null)
    {
        $this->latitude=$latitude;
        return $this;
    }


}

