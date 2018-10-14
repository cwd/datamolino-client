Datamolino Client
=================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cwd/datamolino-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cwd/datamolino-client/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/cwd/datamolino-client/v/stable)](https://packagist.org/packages/cwd/datamolino-client) 
[![Total Downloads](https://poser.pugx.org/cwd/datamolino-client/downloads)](https://packagist.org/packages/cwd/datamolino-client) 
[![Latest Unstable Version](https://poser.pugx.org/cwd/datamolino-client/v/unstable)](https://packagist.org/packages/cwd/datamolino-client) 
[![License](https://poser.pugx.org/cwd/datamolino-client/license)](https://packagist.org/packages/cwd/datamolino-client)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/cwd/datamolino-client/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)


see https://datamolino.docs.apiary.io/#introduction/how-to-start-using-datamolino-api

This Datamolino Client is currently compatible with version **1.2.2** of the Datamolino API 

Dependencies:
------------

* php >=7.1
* ext-json
* php-http/guzzle6-adapter ^1.1,
* php-http/discovery ^1.0
* symfony/serializer-pack ~1.0
* symfony/finder ~3.3 || ~4.0
* symfony/http-foundation ~3.3 || ~4.0


Installation:
------------
`composer require cwd/datamolino-client`

Usage:
------

#### Authentication
```
$datamolino = new DatamolinoClient();

// Get a Token via password authentication
$token = $datamolino->getClient()->authenticatePassword($clientID, $clientSecret, $username, $password);

// Store the token for later use
// you can refresh your token any time by using
$token = $datamolino->getClient()->refreshToken($clientID, $clientSecret, $token->getRefreshToken());

// If you have stored the token elsewhere just build the object:
$token = (new Token())->setAccessToken($accessToken)
                      ->setRefreshToken($refreshToken)
                      ->setsetExpiresIn($expiresIn);

// Set the token in the Client
$datamolino->getClient()->setToken($token);
```    
    
    
####User Endpoint
```
// me   
$user = $datamolino->user()->me();
```
    
#####Agenda Endpoint
```
// get all agendas
$agendas = $datamolino->agenda()->getAll();

// get agenda by id
$agenda = $datamolino->agenda()->get(4050);

// update
$agenda->setName('My Agenda Name')
       ->getAddress()->setBuildingNo(2);
$datamolino->agenda()->update($agenda);
    
// create    
$agenda = new Agenda();
$agenda->setName('My Other Agenda')
       ->setAddress((new Address())
            ->setStreet('Example')
            ->setBuildingNo(125)
            ->setCountry('at')
            );
$agenda = $datamolino->agenda()->create($agenda, $lacyLoad = true);
    
// delete    
$datamolino->agenda()->delete(4063);
```
    
####Document Endpoint
```    
// Find documents
$documents = $datamolino->document()->find(4050, [], new \DateTime('2018-10-10 21:59:21'));

// Get document by id
$document = $datamolino->document()->get(268145);

// Upload multiple documents via finder
$finder = new Finder();
$documents = $datamolino->document()->createByFinder($finder->in('../testdata'), 4050, Document::DOCTYPE_PURCHASE, false, true);

// send repair request for a document
$datamolino->document()->repair(268138, 'API test ignore');

// Delete document
$datamolino->document()->delete(268145);
```    