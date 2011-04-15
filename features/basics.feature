Feature: Basic Parsing of Doc Comments
  In order to obtain useful information from doc comments
  As a programmer
  I want to be able to parse doc comments
  
  Scenario: Parse basic doc comment
    Given I have a doc comment
      """
      /**
       * This is my description
       */
      """
      And I have a  doc comment parser
      And I parse the doc comment with the parser
     Then I should get "This is my description" when I ask for the doc comment description
