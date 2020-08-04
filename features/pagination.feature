Feature: Use Pagination to filter result
  As a developer
  In order to limit a result
  I need to paginate the result

  Background:
    Given I have the following dataset
    | id | name                  | tags         | created_at | activated_at | is_active | price |
    | 1  | Chocolate chip cookie |              | 2000-01-01 | null         | false     | 2.50$ |
    | 2  | Banana                | fruit,yellow | 2001-07-21 | 2003-08-30   | true      | 0.50$ |
    | 3  | Sausages              | meat         | 2010-04-11 | 2005-02-01   | true      | 5.30$ |

  Scenario: Return all the data set when no parameters are given
    When I request the url "/dataset"
    Then I should have the following ids "1,2,3"
