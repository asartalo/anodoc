Feature: Basic Parsing of Doc Comments
  In order to obtain useful information from doc comments
  As a programmer
  I want to be able to parse doc comments
  
  Background:
    Given I have a  doc comment parser
    
  
  Scenario: Parse doc comment with description
    Given I have a doc comment
      """
      /**
       * This is my description
       */
      """
      And I parse the doc comment with the parser
     Then when I ask for the doc comment description, I should get "This is my description" 
  
  Scenario: Parse doc comment with multi-line description
    Given I have a doc comment
      """
      /**
       * This is my description that spans
       * multiple lines
       */
      """
      And I parse the doc comment with the parser
     Then when I ask for the doc comment description, I should get "This is my description that spans multiple lines"
