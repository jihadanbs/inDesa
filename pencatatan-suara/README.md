# voice-recorder
Simple browser voice recorder.

## Install
Publish code to a server with PHP (tested with version 7). Runtime (PHP server user) must have rights for writing to the falder `data/`. 

Also, modern browsers block `MediaStream Recording API` (required for recording) unless the communication is over HTTPS/TLS.

For security, whole site should be protected with `.htpasswd`. Use for example [this](https://www.web2generators.com/apache-tools/htpasswd-generator) tool to generate `.htpasswd` file with usernames and passwords.

## Usage
Publish dataset(s) to the folder `datasets/`. A dataset is a file with a sentence/paragraph per line. User is presented each time with a random line (sentence/paragraph) from the given dataset.

Recordings are stored in folder `data/`. For each user is created a new folder here. Each recording has name in format `dataset-line_id[_duplications].ogg`.

Each user should enter his/her name or ID (to resume work for example), by default there is a random string generated.