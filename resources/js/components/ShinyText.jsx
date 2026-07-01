import React from 'react';
import { motion } from 'framer-motion';

const ShinyText = ({ text = '', className = '', speed = 3 }) => {
  return (
    <motion.span
      className={`inline-block relative overflow-hidden bg-clip-text text-transparent bg-gradient-to-r from-transparent via-white to-transparent ${className}`}
      style={{
        WebkitBackgroundClip: 'text',
        backgroundSize: '200% 100%',
        backgroundColor: 'currentColor'
      }}
      animate={{
        backgroundPosition: ['-100% 0', '200% 0'],
      }}
      transition={{
        repeat: Infinity,
        duration: speed,
        ease: 'linear',
      }}
    >
      <span className="text-transparent" style={{ WebkitTextStroke: '1px currentColor' }}>
        {text}
      </span>
    </motion.span>
  );
};

export default ShinyText;
