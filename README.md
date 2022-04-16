# Job Batching API

This is a sales recording app in which users can use to store a large record their sales from a csv file into the database. Project uses the laravel job batching features to allow users to be ablt to upload data from csv files with alot of records. For this project we have a [demo csv file](./csvfiles/csv-50k-Sales-Records.csv) which can be used to test the project. The project can be used with it's [app](https://github.com/adejam/sales-uploader)

> Please note that it only shows how job queueing and batching works in laravel but doesn't taker other things into consideration like codebase structure, migration data type, returning a good json response and more.

> This project is not hosted online and not connected to an remote database and would need to be set up locally to be used



## Features

- Upload a sales record to the database - note, check [demo csv file](./csvfiles/csv-50k-Sales-Records.csv) or [sales migration table](./database/migrations/2022_04_03_101409_create_sales_table.php) to see the format for the csvfile.
- Get a batch with a particular id 
- Get first batch with pending jobs.

## API Endpoint Documentation

### `/upload`: Used to upload sales record to the database
   - Method: `POST`
   - Body Params: Only the the `mycsv` parameter is needed in the request for which the sales csvfile sent
   - Query Params: none.
   - Response:
        - Success: 
            ```bash
                {
                    "id":"9613ebe3-e791-4819-86e4-38ab3a75318b",
                    "name":"",
                    "totalJobs":0,
                    "pendingJobs":0,
                    "processedJobs":0,"progress":0,
                    "failedJobs":0,
                    "options":[],
                    "createdAt":"2022-04-16T15:31:01.000000Z",
                    "cancelledAt":null,"finishedAt":null
                }
            ```

### `/batch/{id}`: Used to get a batch by id
   - Method: `GET`
   - Body Params: none.
   - Query Params: 
    - id: Id of the batch to get
   - Response:
        - Success: 
            ```bash
                {
                    "id":"9613ebe3-e791-4819-86e4-38ab3a75318b",
                    "name":"",
                    "totalJobs":51,
                    "pendingJobs":45,
                    "processedJobs":6,"progress":12,
                    "failedJobs":0,
                    "options":[],
                    "createdAt":"2022-04-16T15:31:01.000000Z",
                    "cancelledAt":null,"finishedAt":null
                }
            ```

### `/batch/in-progress`: used to find the first batch that is still in progress
   - Method: `GET`
   - Body Params: none.
   - Query Params: none.
   - Response:
        - Success: 
            ```bash
                {
                    "id":"9613ebe3-e791-4819-86e4-38ab3a75318b",
                    "name":"","totalJobs":51,
                    "pendingJobs":22,
                    "processedJobs":29,
                    "progress":57,
                    "failedJobs":0,
                    "options":[],
                    "createdAt":"2022-04-16T15:31:01.000000Z",
                    "cancelledAt":null,
                    "finishedAt":null
                }
            ```
   
## Setup the project locally (Running locally)

-   Clone the project

```bash
git clone https://github.com/adejam/job-batching-backend

```

-   Install Dependencies

```bash
composer install
```

- Setup Database and migrate tables with seeders

```bash
php artisan migrate:fresh --seed
```

To check for errors on PHP

```bash
composer phpcs
```

Or to beautify PHP codes and fix phpcs errors

```bash
composer phpcbf
```
