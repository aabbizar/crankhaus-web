import React from 'react';

const AuroraBackground = ({ children, className = '', colorStops = ['#00d8ff', '#ff0055', '#ff9900', '#00ffaa'] }) => {
  return (
    <div className={`relative flex flex-col h-full w-full bg-black overflow-hidden ${className}`}>
      <div className="absolute inset-0 overflow-hidden">
        <div 
          className="absolute -inset-[10px] opacity-60"
          style={{
            backgroundImage: `repeating-linear-gradient(to bottom, transparent, transparent 2px, black 2px, black 4px)`,
            backgroundSize: '100% 4px',
            zIndex: 1
          }}
        />
        <div 
          className="absolute inset-0 filter blur-[80px] animate-aurora"
          style={{
            background: `conic-gradient(from 0deg at 50% 50%, ${colorStops.join(', ')})`,
            animation: 'aurora 15s linear infinite',
            transformOrigin: 'center center',
            width: '200%',
            height: '200%',
            top: '-50%',
            left: '-50%'
          }}
        />
        {/* Subtle grid pattern for vaporwave feel */}
        <div 
          className="absolute inset-0 opacity-20 pointer-events-none"
          style={{
            backgroundImage: 'linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px)',
            backgroundSize: '40px 40px',
            zIndex: 2
          }}
        />
      </div>
      <div className="relative z-10 h-full w-full flex flex-col justify-center items-center">
        {children && <div dangerouslySetInnerHTML={{ __html: children }} />}
      </div>
    </div>
  );
};

export default AuroraBackground;
