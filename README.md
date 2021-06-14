# Jump24 PHP Coding Test

This test has been designed to allow us to see your Laravel knowledge and how you approach a given problem.

If you have any questions regarding this test you can email team@jump24.co.uk and we will answer any questions that you
may have.

We recommend taking no more than 1 hour to complete the task, remember that if in this time you don't complete the task
this won't have a negative effect on your result, a lot of this test is about your approach and how you aim/aimed to 
tackle the problem at hand. This will be discussed in a quick call once the task is completed.

## What do we expect?

Using the project provided we want you to integrate with a 3rd party API to pull in user data.

We want this to be maintainable and flexible to potentially add other API calls to the future.
This code might also be used in other parts of the application to get a fresh set of the data from the API.

There's a few pointers we would like you to think about when coming up with your solutions:

- How we would be able to test this using PHPUnit in the future if we needed to?
- Don't always write everything yourself you can pull in other packages if you feel they are needed.
- What happens if the API that you're calling goes down how does the system react to this?

## Task

Build a console command that pulls data from an API and stores it against the User model, this command should not have
any user interaction at all but should have a way to call the next page in the pagination on the API, so if a there are 
12 total pages this command should be developed in a way to call these other pages so we can potentially retrieve all 
the data from the API (again this isnt required but it would be great to see/hear how you would approach this.)

- Call the [https://reqres.in/] API to pull in the first page of users only.

We could potentially use this command in a schedule to repeatedly update the users from the API, think about how this
could be achieved in your command.
