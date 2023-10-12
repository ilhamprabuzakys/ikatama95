/* begin:: 3d logo */
import * as THREE from 'three';
import { OrbitControls } from 'https://unpkg.com/three@0.145.0/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'https://unpkg.com/three@0.145.0/examples/jsm/loaders/GLTFLoader.js';
// import { DRACOLoader } from 'https://unpkg.com/three@0.145.0/examples/jsm/loaders/DRACOLoader.js';

var container = document.getElementById('3dLogo');

var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);

var renderer = new THREE.WebGLRenderer({ alpha: true });
container.appendChild(renderer.domElement);

var controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.enabled = false;

var ambientLight = new THREE.AmbientLight(0x404040, 1);
scene.add(ambientLight);

var directionalLight = new THREE.DirectionalLight(0xffffff, 5);
directionalLight.position.set(2, 2, 5);
scene.add(directionalLight);

var object3D;
var loader = new GLTFLoader();

loader.load(
   'models/school.gltf',
   function (gltf) {
      object3D = gltf.scene;
      scene.add(object3D);
      // Scale the 3D object to make it larger
      // object3D.scale.set(2, 2, 2); // You can adjust the scale factor as needed
      scene.add(object3D);
      var box = new THREE.Box3().setFromObject(object3D);
      var center = box.getCenter(new THREE.Vector3());
      var distance = box.getSize(new THREE.Vector3()).length();
      controls.target.copy(center);
      camera.position.copy(center);
      camera.position.z += distance - 0.95;
   },
   undefined,
   function (error) {
      console.error('Error loading GLTF model:', error);
   }
);

camera.position.z = 10;

function onWindowResize() {
   const width = container.clientWidth;
   const height = container.clientHeight;
   camera.aspect = width / height;
   camera.updateProjectionMatrix();
   renderer.setSize(width, height);
}

function onContainerResize() {
   const width = container.clientWidth;
   const height = container.clientHeight;
   const aspect = width / height;
   camera.aspect = aspect;
   camera.updateProjectionMatrix();
   renderer.setSize(width, height);
}
onContainerResize();
const resizeObserver = new ResizeObserver(onContainerResize);
resizeObserver.observe(container);

function animate() {
   requestAnimationFrame(animate);
   if (object3D) {
      object3D.rotation.y += 0.01;
   }
   renderer.render(scene, camera);
}
animate();