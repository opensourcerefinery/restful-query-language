Feature: Use Pagination to filter result
  As a developer
  In order to limit a result
  I need to paginate the result

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
