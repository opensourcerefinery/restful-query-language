Feature: Use Pagination to filter result
  As a developer
  In order to limit a result
  I need to paginate the result

  Background:
    Given The fixture data
    | id | first_name | last_name | is_active | gender | created_at | updated_at |
    | 1  | John       | Smith     | true      | male   | 2000-01-01 | 2000-02-01 |
    | 2  | Jane       | Smith     | true      | female | 2000-01-01 | 2000-02-01 |
    | 3  | Joe        | Dalton    | true      | male   | 2000-01-02 | 2000-03-01 |
    | 4  | Jack       | Dalton    | true      | male   | 2000-01-02 | 2000-03-01 |
    | 5  | William    | Dalton    | true      | male   | 2000-01-03 | 2000-04-01 |
    | 6  | Averell    | Dalton    | true      | male   | 2000-01-03 | 2000-04-01 |
    | 7  | Ma         | Dalton    | true      | female | 2000-01-04 | 2000-05-01 |
    | 8  | Lucky      | Luke      | true      | male   | 2000-01-04 | 2000-05-01 |

  Scenario: Return all the data when no parameters are given
    When I request the url with the page parameter
    | |
    | |
    Then I should have the following response
  """
  []
  """

  Scenario: Return all the data based on offset format
    When I request the url with the page parameter
      | start | limit |
      | 1     | 1     |
    Then I should have the following response
"""
{
    "start": 1,
    "limit": 1
}
"""

  Scenario: Return all the data based on before cursor format
    When I request the url with the page parameter
      | before | size |
      | abc    | 1    |
    Then I should have the following response
"""
{
    "before": "abc",
    "limit": 1
}
"""

  Scenario: Return all the data based on after cursor format
    When I request the url with the page parameter
      | after | size |
      | abc   | 1    |
    Then I should have the following response
"""
{
    "after": "abc",
    "limit": 1
}
"""
