<?php

use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @var \Drupal\hello_world\HelloWorldSalutation
 */
protected $salutation;
/**
 * HelloWorldController constructor.
 *
 * @param \Drupal\hello_world\HelloWorldSalutation $salutation
 */

 // dependency injection for the service happens here:
public function __construct(HelloWorldSalutation $salutation) {
  $this->salutation = $salutation;
}
/**
 * {@inheritdoc}
 */
public static function create(ContainerInterface $container) {
  return new static(
    $container->get('hello_world.salutation')
  );
}
namespace Drupal\hello_world\Controller;
use Drupal\Core\Controller\ControllerBase;
/**
 * Controller for the salutation message.
 */
class HelloWorldController extends ControllerBase {
  /**
   * Hello World.
   *
   * @return array
   *   Our message.
   */
  public function helloWorld() {
    return [
      '#markup' => $this->getSalutation(),
    ];
  }
}