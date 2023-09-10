# Mars Rover: tests and architecture kata

⚠️⚠️ Please, do not open the folder `tests/AlmostHidden` until asked to do so.

This kata is based on the traditional [Mars Rover kata](https://code.google.com/archive/p/marsrovertechchallenge/), but with a twist.

The implementation has already been coded. The CLI `KataStarter\OrderMarsRoverCli` allows to order several Mars rovers to make them move and turn.

Launch and play with the following command to see how it works:

```php
docker compose run --rm php bin/console order --help
```

## Exercise 1

⏲ 20 minutes + 10 minutes debrief

How would you test the code present in `src`? (Apart from `MarsRoverPositionsJsonRepository.php`, you can forget about that file for now):

- which tests classes would you create?
- what kind of tests would they contain?
- for each test class, write all the test cases you would test
- for each test class, implement one test case (pseudo-code is fine)
- what would be the test strategy?
- what would be the test coverage?

You can write pseudo-code or take shortcuts if you want. The code doesn't have to compile and tests don't have to be green. 

## Exercise 2

⏲ 5 minutes + 25 minutes debrief

Now, let's have a look at the `tests/AlmostHidden` folder. It contains test classes that tests code. (You can forget about `tests/AlmostHidden/MarsRoverPositionJsonRepositoryTest.php` for now).

How does it compare with your solution? What are the pros and cons of each approach?

## Exercise 3

Sending orders to Mars or receiving information from it can take a long time... That's why we need to be able to save the positions of the rovers somewhere, so that we can retrieve them later.

The CLI `order` must now only order the rovers (and not retrieve their positions). The new CLI `locate` must retrieve the positions of the rovers.

The `MarsRoverPositionsJsonRepository` class that has been provided is responsible for saving and retrieving the positions of the rovers in a JSON file. 

