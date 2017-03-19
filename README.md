# Turiknox Google Trusted Stores

## Overview

A simple Magento module that will allow you to integrate the Google Trusted Stores badge and order confirmation code.

Please note that the module does not support the optional Google Shopping parameters or the user defined badge position.

## Requirements

Magento 2.1.x

## Installation

Copy the contents into your Magento project directory and enable the module via the command line:

/path/to/php bin/magento module:enable Turiknox_TrustedStores

Run the database upgrade and compile commands:

/path/to/php bin/magento setup:upgrade
/path/to/php bin/magento setup:di:compile

## Usage

Stores -> Configuration -> Google API -> Google Trusted Stores.