# Local Setup
## Pre-requisites
1. The following must be installed on Operating System: Git, Docker, Docker Compose, DDEV
2. Instructions here are by default for MacOS. Though, it has been tested in Linux and Windows environment.
3. Current Dev Setup require Ports 80, 3306, 9200, 1025, 8025 and 11211. Please ensure ports are free: `lsof -t -i :80 `

## Installation
1. Clone the repo
2. Checkout the branch `master`
3. Download the latest DB dump: https://drive.google.com/file/d/1zUT838JqUKOd0fIu0TcMoEaoZNXoSTCv/view?usp=drive_link
4. Start Docker containers from the root of the repository
    ```sh
    $ ddev start
    ```
5. Install packages and dependencies
    ```sh
    $ ddev composer install
    ```
6. Import the recently downloaded DB dump
    ```sh
    $ ddev import-db --src /path/to/the/db.sql.gz
    ```
7. Import the configuration 
    ```sh
    $ ddev drush cim -y
    ```
8. Generate one time login link to admin account
    ```sh
    $ ddev drush uli
    ```

## Custom REST Resource
/api/event-listing
